<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\DispatchSource;

use Nette\Application\Responses\TextResponse;
use Nette\Application\UI\Presenter;


final class ResponsePresenter extends Presenter
{

	protected function startup()
	{
		parent::startup();
		$this->autoCanonicalize = FALSE;
	}


	public function actionDefault()
	{
		$this->sendResponse(new TextResponse(NULL));
	}

}
