<?php

namespace App\Services;

use App\Models\PostComment;
use App\DataTables\PostCommentDataTable;
use Illuminate\Http\Request;

class PostCommentService
{
	
	public static function dataTable()
	{
		return (new PostCommentDataTable)->render();
	}

	public static function create($data)
	{
		$postComment = PostComment::create($data);

        return $postComment->load('user');
	}

	public static function moderate(PostComment $postComment, String $status)
	{
		$postComment->status = $status;
        $postComment->save();

        return self::moderateResponse($status);
	}

	public static function delete(PostComment $postComment)
	{
		$postComment->delete();
	}

	private static function moderateResponse(String $status)
	{
		$response = [];

		switch($status) {
			case 'AP':
				$response = ['type' => 'success', 'message' => 'O comentário foi aprovado!'];
				break;
			case 'SP':
				$response = ['type' => 'warning', 'message' => 'O comentário foi marcado como spam!'];
				break;
			case 'BL':
				$response = ['type' => 'danger', 'message' => 'O comentário foi bloqueado!'];
				break;
		}

		return response()->json($response, 200);
	}
}