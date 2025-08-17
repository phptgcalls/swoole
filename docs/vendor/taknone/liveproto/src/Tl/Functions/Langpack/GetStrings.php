<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Langpack;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_pack string lang_code Vector<string> keys
 * @return Vector<LangPackString>
 */

final class GetStrings extends Instance {
	public function request(string $lang_pack,string $lang_code,array $keys) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xefea3803);
		$writer->tgwriteBytes($lang_pack);
		$writer->tgwriteBytes($lang_code);
		$writer->tgwriteVector($keys,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>