<?php 
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->book_id = $bookId;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
    }
}
