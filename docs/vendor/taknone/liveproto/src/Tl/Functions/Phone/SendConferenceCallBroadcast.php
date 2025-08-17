<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call bytes block
 * @return Updates
 */

final class SendConferenceCallBroadcast extends Instance {
	public function request(object $call,string $block) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc6701900);
		$writer->write($call->read());
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