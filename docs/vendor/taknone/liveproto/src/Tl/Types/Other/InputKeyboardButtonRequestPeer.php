<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text int button_id requestpeertype peer_type int max_quantity true name_requested true username_requested true photo_requested
 * @return KeyboardButton
 */

final class InputKeyboardButtonRequestPeer extends Instance {
	public function request(string $text,int $button_id,object $peer_type,int $max_quantity,? true $name_requested = null,? true $username_requested = null,? true $photo_requested = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc9662d05);
		$flags = 0;
		$flags |= is_null($name_requested) ? 0 : (1 << 0);
		$flags |= is_null($username_requested) ? 0 : (1 << 1);
		$flags |= is_null($photo_requested) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($text);
		$writer->writeInt($button_id);
		$writer->write($peer_type->read());
		$writer->writeInt($max_quantity);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['name_requested'] = true;
		else:
			$result['name_requested'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['username_requested'] = true;
		else:
			$result['username_requested'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['photo_requested'] = true;
		else:
			$result['photo_requested'] = false;
		endif;
		$result['text'] = $reader->tgreadBytes();
		$result['button_id'] = $reader->readInt();
		$result['peer_type'] = $reader->tgreadObject();
		$result['max_quantity'] = $reader->readInt();
		return new self($result);
	}
}

?>