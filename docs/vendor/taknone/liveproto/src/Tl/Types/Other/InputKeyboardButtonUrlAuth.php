<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text string url inputuser bot true request_write_access string fwd_text
 * @return KeyboardButton
 */

final class InputKeyboardButtonUrlAuth extends Instance {
	public function request(string $text,string $url,object $bot,? true $request_write_access = null,? string $fwd_text = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd02e7fd4);
		$flags = 0;
		$flags |= is_null($request_write_access) ? 0 : (1 << 0);
		$flags |= is_null($fwd_text) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($text);
		if(is_null($fwd_text) === false):
			$writer->tgwriteBytes($fwd_text);
		endif;
		$writer->tgwriteBytes($url);
		$writer->write($bot->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['request_write_access'] = true;
		else:
			$result['request_write_access'] = false;
		endif;
		$result['text'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['fwd_text'] = $reader->tgreadBytes();
		else:
			$result['fwd_text'] = null;
		endif;
		$result['url'] = $reader->tgreadBytes();
		$result['bot'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>