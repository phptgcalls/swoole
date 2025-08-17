<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text int button_id requestpeertype peer_type int max_quantity
 * @return KeyboardButton
 */

final class KeyboardButtonRequestPeer extends Instance {
	public function request(string $text,int $button_id,object $peer_type,int $max_quantity) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x53d7bfd8);
		$writer->tgwriteBytes($text);
		$writer->writeInt($button_id);
		$writer->write($peer_type->read());
		$writer->writeInt($max_quantity);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['button_id'] = $reader->readInt();
		$result['peer_type'] = $reader->tgreadObject();
		$result['max_quantity'] = $reader->readInt();
		return new self($result);
	}
}

?>