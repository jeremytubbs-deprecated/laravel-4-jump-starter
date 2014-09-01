<?php

class ContactController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /contact
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('contact.index');
	}

	/**
	 * Send the Email from Contact Form
	 * GET /contact/create
	 *
	 * @return Response
	 */
	public function send()
	{
		if (Input::get('human') == true) {
			$data = array(
				'name' => Input::get('name'),
				'email' => Input::get('email'),
				'the_message' => Input::get('message')
			);
			$rules = array(
				'name' => 'required',
				'email' => 'required|email',
				'the_message' => 'required'
			);
			$validator = Validator::make($data, $rules);
			if ($validator->passes()) {
				Mail::send('emails.contact', $data, function($message)
				{
					$message->from(Input::get('email'))->to($_ENV['MAIL_USERNAME'])->subject($_ENV['SITE_NAME'] . ' Contact Form');
				});

				return Redirect::back()->with('flash_message', 'Thanks your message has been sent.');
			}

			$error = $validator->messages();
			return Redirect::back()->with('flash_message', $error);
		}

		return Redirect::back()->with('flash_message', 'You are not a human?')->withInput();
	}

}