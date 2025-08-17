<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text bool quiz
 * @return KeyboardButton
 */

final class KeyboardButtonRequestPoll extends Instance {
	public function request(string $text,? bool $quiz = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbbc7515d);
		$flags = 0;
		$flags |= is_null($quiz) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($quiz) === false):
			$writer->tgwriteBool($quiz);
		endif;
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['quiz'] = $reader->tgreadBool();
		else:
			$result['quiz'] = null;
		endif;
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>