<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q
 * @return ChannelParticipantsFilter
 */

final class ChannelParticipantsSearch extends Instance {
	public function request(string $q) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x656ac4b);
		$writer->tgwriteBytes($q);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['q'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>