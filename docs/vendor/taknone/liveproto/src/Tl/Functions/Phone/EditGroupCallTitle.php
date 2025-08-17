<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call string title
 * @return Updates
 */

final class EditGroupCallTitle extends Instance {
	public function request(object $call,string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1ca6ac0a);
		$writer->write($call->read());
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>