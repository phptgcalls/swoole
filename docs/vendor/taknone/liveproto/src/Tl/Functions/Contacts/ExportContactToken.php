<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return ExportedContactToken
 */

final class ExportContactToken extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf8654027);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>