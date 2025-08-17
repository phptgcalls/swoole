<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call true can_self_unmute
 * @return phone.ExportedGroupCallInvite
 */

final class ExportGroupCallInvite extends Instance {
	public function request(object $call,? true $can_self_unmute = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe6aa647f);
		$flags = 0;
		$flags |= is_null($can_self_unmute) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($call->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>