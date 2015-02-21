<?php
namespace AgoraTeam\Agora\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Phillip Thiele <philipp.thiele@phth.de>
 *           Björn Christopher Bresser <bjoern.bresser@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ThreadController
 */
class ThreadController extends ActionController {

	/**
	 * threadRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\ThreadRepository
	 * @inject
	 */
	protected $threadRepository = NULL;

	/**
	 * frontendUserRepository
	 *
	 * @var
	 * @inject
	 */
	protected $frontendUserRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$threads = $this->threadRepository->findAll();
		$this->view->assign('threads', $threads);
	}

	/**
	 * action show
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function showAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$this->view->assign('thread', $thread);
	}

	/**
	 * action new
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $newThread
	 * @ignorevalidation $newThread
	 * @return void
	 */
	public function newAction(\AgoraTeam\Agora\Domain\Model\Thread $newThread = NULL) {
		$this->view->assign('newThread', $newThread);
	}

	/**
	 * action create
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $newThread
	 * @return void
	 */
	public function createAction(\AgoraTeam\Agora\Domain\Model\Thread $newThread) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->threadRepository->add($newThread);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @ignorevalidation $thread
	 * @return void
	 */
	public function editAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$this->view->assign('thread', $thread);
	}

	/**
	 * action update
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function updateAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->threadRepository->update($thread);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function deleteAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->threadRepository->remove($thread);
		$this->redirect('list');
	}

	/**
	 * action listLatest
	 *
	 * @return void
	 */
	public function listLatestAction() {
		$user = '';
		$limit = $this->settings['threads']['numberOfItemsInLatestView'];
		$latestThreads = $this->threadRepository->findLatestThreadsForUser($limit, $user);
		$this->view->assign('latestThreads', $latestThreads);
	}

}