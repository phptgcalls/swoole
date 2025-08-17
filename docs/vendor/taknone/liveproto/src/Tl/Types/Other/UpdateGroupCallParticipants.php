<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call Vector<GroupCallParticipant> participants int version
 * @return Update
 */

final class UpdateGroupCallParticipants extends Instance {
	public function request(object $call,array $participants,int $version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf2ebdb4e);
		$writer->write($call->read());
		$writer->tgwriteVector($participants,'GroupCallParticipant');
		$writer->writeInt($version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['call'] = $reader->tgreadObject();
		$result['participants'] = $reader->tgreadVector('GroupCallParticipant');
		$result['version'] = $reader->readInt();
		return new self($result);
	}
}

?>