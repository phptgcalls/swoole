<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text string url int button_id string fwd_text
 * @return KeyboardButton
 */

final class KeyboardButtonUrlAuth extends Instance {
	public function request(string $text,string $url,int $button_id,? string $fwd_text = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x10b78d29);
		$flags = 0;
		$flags |= is_null($fwd_text) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($text);
		if(is_null($fwd_text) === false):
			$writer->tgwriteBytes($fwd_text);
		endif;
		$writer->tgwriteBytes($url);
		$writer->writeInt($button_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['text'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['fwd_text'] = $reader->tgreadBytes();
		else:
			$result['fwd_text'] = null;
		endif;
		$result['url'] = $reader->tgreadBytes();
		$result['button_id'] = $reader->readInt();
		return new self($result);
	}
}

?>