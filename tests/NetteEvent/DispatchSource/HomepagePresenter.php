<?php

namespace Symnedi\EventDispatcher\Tests\NetteEvent\DispatchSource;

use Nette\Application\UI\Presenter;


final class HomepagePresenter extends Presenter
{

	public function actionDefault()
	{
		$this->terminate();
	}

}
