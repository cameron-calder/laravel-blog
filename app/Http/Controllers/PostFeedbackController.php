<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Models\Post;
use App\View\Components\PostFeedbackActions;
use Illuminate\Http\Request;

class PostFeedbackController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {   
        $feedback = Feedback::firstOrNew([
            'post_id' => $request->get('post_id'),
            'created_by' => auth()->user()->id,
        ]);

        if ($request->get('type') == 'none') {
            $feedback->delete();
        } else {
            $feedback->type = $request->get('type');
            $feedback->save();
        }

        $post = $feedback->post()
            ->withCount([
                'likeFeedback', 
                'dislikeFeedback',
            ])
            ->with(['userFeedback'])
            ->first();

        return (new PostFeedbackActions())
            ->render()
            ->with('post', $post);
    }
}
