<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int reply_to_msg_id int top_msg_id inputpeer reply_to_peer_id string quote_text Vector<MessageEntity> quote_entities int quote_offset inputpeer monoforum_peer_id int todo_item_id
 * @return InputReplyTo
 */

final class InputReplyToMessage extends Instance {
	public function request(int $reply_to_msg_id,? int $top_msg_id = null,? object $reply_to_peer_id = null,? string $quote_text = null,? array $quote_entities = null,? int $quote_offset = null,? object $monoforum_peer_id = null,? int $todo_item_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x869fbe10);
		$flags = 0;
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$flags |= is_null($reply_to_peer_id) ? 0 : (1 << 1);
		$flags |= is_null($quote_text) ? 0 : (1 << 2);
		$flags |= is_null($quote_entities) ? 0 : (1 << 3);
		$flags |= is_null($quote_offset) ? 0 : (1 << 4);
		$flags |= is_null($monoforum_peer_id) ? 0 : (1 << 5);
		$flags |= is_null($todo_item_id) ? 0 : (1 << 6);
		$writer->writeInt($flags);
		$writer->writeInt($reply_to_msg_id);
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		if(is_null($reply_to_peer_id) === false):
			$writer->write($reply_to_peer_id->read());
		endif;
		if(is_null($quote_text) === false):
			$writer->tgwriteBytes($quote_text);
		endif;
		if(is_null($quote_entities) === false):
			$writer->tgwriteVector($quote_entities,'MessageEntity');
		endif;
		if(is_null($quote_offset) === false):
			$writer->writeInt($quote_offset);
		endif;
		if(is_null($monoforum_peer_id) === false):
			$writer->write($monoforum_peer_id->read());
		endif;
		if(is_null($todo_item_id) === false):
			$writer->writeInt($todo_item_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['reply_to_msg_id'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['top_msg_id'] = $reader->readInt();
		else:
			$result['top_msg_id'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['reply_to_peer_id'] = $reader->tgreadObject();
		else:
			$result['reply_to_peer_id'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['quote_text'] = $reader->tgreadBytes();
		else:
			$result['quote_text'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['quote_entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['quote_entities'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['quote_offset'] = $reader->readInt();
		else:
			$result['quote_offset'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['monoforum_peer_id'] = $reader->tgreadObject();
		else:
			$result['monoforum_peer_id'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['todo_item_id'] = $reader->readInt();
		else:
			$result['todo_item_id'] = null;
		endif;
		return new self($result);
	}
}

?>