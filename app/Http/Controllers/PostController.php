<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Cart;

class PostController extends Controller
{
    // Display a listing of the user's posts
    public function index()
    {
        $userPosts = Post::where('user_id', auth()->id())->get();
        return view('posts.index', ['userPosts' => $userPosts]);
    }

    // Display a listing of all posts
    public function allposts()
    {
        $allPosts = Post::all();
        return view('posts.allposts', ['allPosts' => $allPosts]);
    }

    // Display a listing of categoria fashion

    public function fashionpost()
    {
        $fashionpost = Post::where('categoria', 'Fashion')->get();
        return view('posts.categorias.fashion', ['fashionpost' => $fashionpost]);
    }

    // Display a listing of categoria electronic

    public function electronicspost()
    {
        $electronicspost = Post::where('categoria', 'Electronics')->get();
        return view('posts.categorias.electronics', ['electronicspost' => $electronicspost]);
    }

    // Display a listing of categoria Toys and Hobbies
    public function toys_and_hobbiespost()
    {
        $toys_and_hobbiespost = Post::where('categoria', 'Toys and Hobbies')->get();
        return view('posts.categorias.toys_and_hobbies', ['toys_and_hobbiespost' => $toys_and_hobbiespost]);
    }


    public function shopping_cart()
    {

    }





    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Show the form for editing a specified post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'bought' => 'nullable|boolean',
            'categoria' => 'required',

        ]);

        $userId = auth()->id();
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('posts'), $imageName);
            $imgPath = 'posts/' . $imageName;
        } else {
            $imgPath = null;
        }

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->img = $imgPath;
        $post->user_id = $userId;
        $post->price = $request->price;
        $post->quantity = $request->quantity;
        $post->bought = $request->has('bought');
        $post->categoria = $request->categoria;

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Update the specified post in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:5048',
            'price' => 'numeric|required',
            'quantity' => 'numeric|required',
            'bought' => 'numeric|required',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('posts'), $imageName);
            $imgPath = 'posts/' . $imageName;
            $post->img = $imgPath;
        }
        $post->price = $request->price;
        $post->quantity = $request->quantity;
        $post->bought = $request->bought;

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Remove the specified post from the database
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->img) {
            $imagePath = $post->img;
            $absoluteImagePath = public_path($imagePath);
            if (file_exists($absoluteImagePath)) {
                unlink($absoluteImagePath);
            }
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }

    // Handle the purchase of a post (decrement quantity, increment bought)
    public function buy(Request $request)
    {
        $postId = $request->input('buy');
        $post = Post::find($postId);
        $user = Auth::user();

        if ($post && $post->quantity > 0 && $user->balance >= $post->price) {
            $user->balance -= $post->price;
            $user->save();

            $post->quantity -= 1;
            $post->bought += 1;
            $post->save();

            return redirect()->back()->with('success', 'Post bought successfully.');
        } else {
            return redirect()->back()->with('error', 'Not enough balance.')->with('delayRedirect', true);
        }
    }





    

// Controller method to handle adding a post to the cart
public function add(Request $request)
{
    $userid = Auth::id();

    $postid = $request->input('post_id');

    $post = Post::find($postid);
    if (!$post) {
        return redirect()->route('posts.allposts')->with('error', 'Post not found.');
    }

    $cart = Cart::firstOrCreate(['user_id' => $userid]);

    $cartPost = $cart->posts()->where('post_id', $postid)->first();
    if ($cartPost) {
        $cartPost->pivot->increment('quantity');
    } else {
        $cart->posts()->attach($postid, ['quantity' => 1]);
    }

    return redirect()->route('posts.allposts')->with('success', 'Post added to cart.');
}


    // Display the specified post along with related posts
    public function show($id)
    {
        $post = Post::find($id);
        $relatedPosts = Post::where('id', '!=', $id)->get();
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        return view('posts.show', compact('post', 'relatedPosts'));
    }




}
