<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string semantics Vector<int> sources
 * @return GroupCallParticipantVideoSourceGroup
 */

final class GroupCallParticipantVideoSourceGroup extends Instance {
	public function request(string $semantics,array $sources) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdcb118b7);
		$writer->tgwriteBytes($semantics);
		$writer->tgwriteVector($sources,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['semantics'] = $reader->tgreadBytes();
		$result['sources'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>