<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text string query true same_peer Vector<InlineQueryPeerType> peer_types
 * @return KeyboardButton
 */

final class KeyboardButtonSwitchInline extends Instance {
	public function request(string $text,string $query,? true $same_peer = null,? array $peer_types = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93b9fbb5);
		$flags = 0;
		$flags |= is_null($same_peer) ? 0 : (1 << 0);
		$flags |= is_null($peer_types) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($text);
		$writer->tgwriteBytes($query);
		if(is_null($peer_types) === false):
			$writer->tgwriteVector($peer_types,'InlineQueryPeerType');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['same_peer'] = true;
		else:
			$result['same_peer'] = false;
		endif;
		$result['text'] = $reader->tgreadBytes();
		$result['query'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['peer_types'] = $reader->tgreadVector('InlineQueryPeerType');
		else:
			$result['peer_types'] = null;
		endif;
		return new self($result);
	}
}

?>