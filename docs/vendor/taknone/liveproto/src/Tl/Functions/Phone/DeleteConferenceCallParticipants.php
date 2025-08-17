<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call Vector<long> ids bytes block true only_left true kick
 * @return Updates
 */

final class DeleteConferenceCallParticipants extends Instance {
	public function request(object $call,array $ids,string $block,? true $only_left = null,? true $kick = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ca60525);
		$flags = 0;
		$flags |= is_null($only_left) ? 0 : (1 << 0);
		$flags |= is_null($kick) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($call->read());
		$writer->tgwriteVector($ids,'long');
		$writer->tgwriteBytes($block);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>