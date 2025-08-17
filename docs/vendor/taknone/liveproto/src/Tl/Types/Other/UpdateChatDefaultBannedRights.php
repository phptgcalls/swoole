<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer chatbannedrights default_banned_rights int version
 * @return Update
 */

final class UpdateChatDefaultBannedRights extends Instance {
	public function request(object $peer,object $default_banned_rights,int $version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x54c01850);
		$writer->write($peer->read());
		$writer->write($default_banned_rights->read());
		$writer->writeInt($version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['default_banned_rights'] = $reader->tgreadObject();
		$result['version'] = $reader->readInt();
		return new self($result);
	}
}

?>