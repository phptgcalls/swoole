<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Langpack;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_pack string lang_code int from_version
 * @return LangPackDifference
 */

final class GetDifference extends Instance {
	public function request(string $lang_pack,string $lang_code,int $from_version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcd984aa5);
		$writer->tgwriteBytes($lang_pack);
		$writer->tgwriteBytes($lang_code);
		$writer->writeInt($from_version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>