<?php

use Nette\Application\Responses\TextResponse;
use Nette\Application\UI\Presenter;


class HomepagePresenter extends Presenter
{

	public function actionDefault()
	{
		$this->terminate();
	}


	public function renderResponse()
	{
		return new TextResponse('OK');
	}

}
