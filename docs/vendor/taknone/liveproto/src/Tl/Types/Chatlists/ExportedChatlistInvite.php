<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Chatlists;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param dialogfilter filter exportedchatlistinvite invite
 * @return chatlists.ExportedChatlistInvite
 */

final class ExportedChatlistInvite extends Instance {
	public function request(object $filter,object $invite) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x10e6e3a6);
		$writer->write($filter->read());
		$writer->write($invite->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['filter'] = $reader->tgreadObject();
		$result['invite'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>