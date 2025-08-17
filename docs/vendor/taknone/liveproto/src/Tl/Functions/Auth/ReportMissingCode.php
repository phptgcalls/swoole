<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash string mnc
 * @return Bool
 */

final class ReportMissingCode extends Instance {
	public function request(string $phone_number,string $phone_code_hash,string $mnc) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcb9deff6);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		$writer->tgwriteBytes($mnc);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>