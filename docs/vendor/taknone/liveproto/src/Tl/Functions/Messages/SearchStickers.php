<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q string emoticon Vector<string> lang_code int offset int limit long hash true emojis
 * @return messages.FoundStickers
 */

final class SearchStickers extends Instance {
	public function request(string $q,string $emoticon,array $lang_code,int $offset,int $limit,int $hash,? true $emojis = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x29b1c66a);
		$flags = 0;
		$flags |= is_null($emojis) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($q);
		$writer->tgwriteBytes($emoticon);
		$writer->tgwriteVector($lang_code,'string');
		$writer->writeInt($offset);
		$writer->writeInt($limit);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>