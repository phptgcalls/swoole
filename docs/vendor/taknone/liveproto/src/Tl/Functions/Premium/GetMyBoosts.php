<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return premium.MyBoosts
 */

final class GetMyBoosts extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbe77b4a);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>