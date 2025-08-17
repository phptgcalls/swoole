<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<GroupCallStreamChannel> channels
 * @return phone.GroupCallStreamChannels
 */

final class GroupCallStreamChannels extends Instance {
	public function request(array $channels) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd0e482b2);
		$writer->tgwriteVector($channels,'GroupCallStreamChannel');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channels'] = $reader->tgreadVector('GroupCallStreamChannel');
		return new self($result);
	}
}

?>