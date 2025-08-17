<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Langpack;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_pack
 * @return Vector<LangPackLanguage>
 */

final class GetLanguages extends Instance {
	public function request(string $lang_pack) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x42c6978f);
		$writer->tgwriteBytes($lang_pack);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>