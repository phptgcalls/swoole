<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string to_lang inputpeer peer Vector<int> id Vector<TextWithEntities> text
 * @return messages.TranslatedText
 */

final class TranslateText extends Instance {
	public function request(string $to_lang,? object $peer = null,? array $id = null,? array $text = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x63183030);
		$flags = 0;
		$flags |= is_null($peer) ? 0 : (1 << 0);
		$flags |= is_null($id) ? 0 : (1 << 0);
		$flags |= is_null($text) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
		if(is_null($id) === false):
			$writer->tgwriteVector($id,'int');
		endif;
		if(is_null($text) === false):
			$writer->tgwriteVector($text,'TextWithEntities');
		endif;
		$writer->tgwriteBytes($to_lang);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>