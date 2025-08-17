<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call true reset_invite_hash bool join_muted
 * @return Updates
 */

final class ToggleGroupCallSettings extends Instance {
	public function request(object $call,? true $reset_invite_hash = null,? bool $join_muted = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x74bbb43d);
		$flags = 0;
		$flags |= is_null($reset_invite_hash) ? 0 : (1 << 1);
		$flags |= is_null($join_muted) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($call->read());
		if(is_null($join_muted) === false):
			$writer->tgwriteBool($join_muted);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>