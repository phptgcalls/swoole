<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string custom_method datajson params
 * @return DataJSON
 */

final class SendCustomRequest extends Instance {
	public function request(string $custom_method,object $params) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaa2769ed);
		$writer->tgwriteBytes($custom_method);
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