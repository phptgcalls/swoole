<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code int from_version int version Vector<EmojiKeyword> keywords
 * @return EmojiKeywordsDifference
 */

final class EmojiKeywordsDifference extends Instance {
	public function request(string $lang_code,int $from_version,int $version,array $keywords) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5cc761bd);
		$writer->tgwriteBytes($lang_code);
		$writer->writeInt($from_version);
		$writer->writeInt($version);
		$writer->tgwriteVector($keywords,'EmojiKeyword');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['lang_code'] = $reader->tgreadBytes();
		$result['from_version'] = $reader->readInt();
		$result['version'] = $reader->readInt();
		$result['keywords'] = $reader->tgreadVector('EmojiKeyword');
		return new self($result);
	}
}

?>