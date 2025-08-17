<?php

declare(strict_types=1);

namespace Tak\Liveproto;

use Composer\Composer;

use Composer\IO\IOInterface;

use Composer\Plugin\PluginInterface;

use Composer\EventDispatcher\EventSubscriberInterface;

use Composer\Script\Event;

use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface , EventSubscriberInterface {
	private Composer $composer;
	private IOInterface $io;
	private ? string $path = null;

	public function activate(Composer $composer,IOInterface $io) : void {
		$this->composer = $composer;
		$this->io = $io;
		$util = new Util($composer);
		$this->path = $util->findInstallPath('taknone/liveproto');
	}
	public function deactivate(Composer $composer,IOInterface $io) : void {
	}
	public function uninstall(Composer $composer,IOInterface $io) : void {
	}
	public static function getSubscribedEvents() : array {
		return array(
			ScriptEvents::POST_AUTOLOAD_DUMP=>'onPostAutoloadDump',
			ScriptEvents::POST_INSTALL_CMD=>'onPostInstall',
			ScriptEvents::POST_UPDATE_CMD =>'onPostUpdate',
		);
	}
	public function onPostAutoloadDump(Event $event) : void {
		if(is_null($this->path) === false){
			$this->io->write('<info>Setup...</info>');
			setup($this->path);
		} else {
			$this->io->write('<error>Package path `taknone/liveproto` not found</error>');
		}
	}
	public function onPostInstall(Event $event) : void {
		$this->io->write('<comment>TLGenerator : post-install hook</comment>');
		$this->onPostAutoloadDump($event);
	}
	public function onPostUpdate(Event $event) : void {
		$this->io->write('<comment>TLGenerator : post-update hook</comment>');
		$this->onPostAutoloadDump($event);
	}
}

?>