<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int dc_id
 * @return auth.ExportedAuthorization
 */

final class ExportAuthorization extends Instance {
	public function request(int $dc_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe5bfffcd);
		$writer->writeInt($dc_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>