<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code int from_version int version Vector<LangPackString> strings
 * @return LangPackDifference
 */

final class LangPackDifference extends Instance {
	public function request(string $lang_code,int $from_version,int $version,array $strings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf385c1f6);
		$writer->tgwriteBytes($lang_code);
		$writer->writeInt($from_version);
		$writer->writeInt($version);
		$writer->tgwriteVector($strings,'LangPackString');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['lang_code'] = $reader->tgreadBytes();
		$result['from_version'] = $reader->readInt();
		$result['version'] = $reader->readInt();
		$result['strings'] = $reader->tgreadVector('LangPackString');
		return new self($result);
	}
}

?>