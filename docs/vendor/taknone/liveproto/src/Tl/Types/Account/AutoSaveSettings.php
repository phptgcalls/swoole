<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param autosavesettings users_settings autosavesettings chats_settings autosavesettings broadcasts_settings Vector<AutoSaveException> exceptions Vector<Chat> chats Vector<User> users
 * @return account.AutoSaveSettings
 */

final class AutoSaveSettings extends Instance {
	public function request(object $users_settings,object $chats_settings,object $broadcasts_settings,array $exceptions,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4c3e069d);
		$writer->write($users_settings->read());
		$writer->write($chats_settings->read());
		$writer->write($broadcasts_settings->read());
		$writer->tgwriteVector($exceptions,'AutoSaveException');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['users_settings'] = $reader->tgreadObject();
		$result['chats_settings'] = $reader->tgreadObject();
		$result['broadcasts_settings'] = $reader->tgreadObject();
		$result['exceptions'] = $reader->tgreadVector('AutoSaveException');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>