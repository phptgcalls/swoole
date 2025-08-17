<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param datajson id
 * @return Bool
 */

final class AcceptTermsOfService extends Instance {
	public function request(object $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xee72f79a);
		$writer->write($id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>