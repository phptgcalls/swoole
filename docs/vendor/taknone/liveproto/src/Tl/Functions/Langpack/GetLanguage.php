<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Langpack;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_pack string lang_code
 * @return LangPackLanguage
 */

final class GetLanguage extends Instance {
	public function request(string $lang_pack,string $lang_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6a596502);
		$writer->tgwriteBytes($lang_pack);
		$writer->tgwriteBytes($lang_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>