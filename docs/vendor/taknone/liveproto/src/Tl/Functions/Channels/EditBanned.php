<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputpeer participant chatbannedrights banned_rights
 * @return Updates
 */

final class EditBanned extends Instance {
	public function request(object $channel,object $participant,object $banned_rights) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x96e6cd81);
		$writer->write($channel->read());
		$writer->write($participant->read());
		$writer->write($banned_rights->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>