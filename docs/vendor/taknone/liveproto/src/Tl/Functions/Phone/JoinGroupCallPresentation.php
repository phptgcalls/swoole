<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call datajson params
 * @return Updates
 */

final class JoinGroupCallPresentation extends Instance {
	public function request(object $call,object $params) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcbea6bc4);
		$writer->write($call->read());
		$writer->write($params->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>