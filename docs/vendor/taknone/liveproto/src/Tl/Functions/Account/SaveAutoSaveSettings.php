<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param autosavesettings settings true users true chats true broadcasts inputpeer peer
 * @return Bool
 */

final class SaveAutoSaveSettings extends Instance {
	public function request(object $settings,? true $users = null,? true $chats = null,? true $broadcasts = null,? object $peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd69b8361);
		$flags = 0;
		$flags |= is_null($users) ? 0 : (1 << 0);
		$flags |= is_null($chats) ? 0 : (1 << 1);
		$flags |= is_null($broadcasts) ? 0 : (1 << 2);
		$flags |= is_null($peer) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
		$writer->write($settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>