<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call Vector<InputPeer> ids Vector<int> sources string offset int limit
 * @return phone.GroupParticipants
 */

final class GetGroupParticipants extends Instance {
	public function request(object $call,array $ids,array $sources,string $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc558d8ab);
		$writer->write($call->read());
		$writer->tgwriteVector($ids,'InputPeer');
		$writer->tgwriteVector($sources,'int');
		$writer->tgwriteBytes($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>