<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bokking;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comments::paginate(7);
        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        $bokkings = Bokking::all();
        return view('admin.comments.create', compact('bokkings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'status' => 'required|in:visible,draft,hidden',
            'booking_id' => 'nullable|exists:bokkings,id',
        ]);

        $comment = new Comments();
        $comment->comment = $request->comment;
        $comment->status = $request->status;
        $comment->bokking_id = $request->bokking_id;
        $comment->save();

        return redirect()->route('admin.comments.index');
    }

    public function edit(Comments $comment)
    {
        $bokkings = Bokking::all();

        return view('admin.comments.edit', compact('comment', 'bokkings'));
    }

    public function update(Request $request, Comments $comment)
    {
        $request->validate([
            'comment' => 'required|max:255',
            'status' => 'required|in:visible,draft,hidden',
            'booking_id' => 'nullable|exists:bokkings,id',
        ]);

        $comment->comment = $request->comment;
        $comment->status = $request->status;
        $comment->save();

        return redirect()->route('admin.comments.index');
    }

    public function destroy(Comments $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index');
    }
}
