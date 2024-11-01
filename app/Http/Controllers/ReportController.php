<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, string $id)
    {
        $request->validate([
            'message' => 'required',
            'post_id' => 'nullable|integer',
            'profile_id' => 'nullable|integer'
        ]);

        $post = Post::find($id);

        $report = new Report();
        $report->message = $request->input('message');
        $report->post_id = $id; // تعيين معرف البروفايل  
        $report->profile_id = $post->profile_id; // تعيين معرف البروفايل  


        $report->save();

        return back()->with('success', 'Report created successfully!');
    }
}
