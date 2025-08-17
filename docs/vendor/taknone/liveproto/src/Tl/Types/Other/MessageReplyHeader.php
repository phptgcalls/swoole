<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true reply_to_scheduled true forum_topic true quote int reply_to_msg_id peer reply_to_peer_id messagefwdheader reply_from messagemedia reply_media int reply_to_top_id string quote_text Vector<MessageEntity> quote_entities int quote_offset int todo_item_id
 * @return MessageReplyHeader
 */

final class MessageReplyHeader extends Instance {
	public function request(? true $reply_to_scheduled = null,? true $forum_topic = null,? true $quote = null,? int $reply_to_msg_id = null,? object $reply_to_peer_id = null,? object $reply_from = null,? object $reply_media = null,? int $reply_to_top_id = null,? string $quote_text = null,? array $quote_entities = null,? int $quote_offset = null,? int $todo_item_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6917560b);
		$flags = 0;
		$flags |= is_null($reply_to_scheduled) ? 0 : (1 << 2);
		$flags |= is_null($forum_topic) ? 0 : (1 << 3);
		$flags |= is_null($quote) ? 0 : (1 << 9);
		$flags |= is_null($reply_to_msg_id) ? 0 : (1 << 4);
		$flags |= is_null($reply_to_peer_id) ? 0 : (1 << 0);
		$flags |= is_null($reply_from) ? 0 : (1 << 5);
		$flags |= is_null($reply_media) ? 0 : (1 << 8);
		$flags |= is_null($reply_to_top_id) ? 0 : (1 << 1);
		$flags |= is_null($quote_text) ? 0 : (1 << 6);
		$flags |= is_null($quote_entities) ? 0 : (1 << 7);
		$flags |= is_null($quote_offset) ? 0 : (1 << 10);
		$flags |= is_null($todo_item_id) ? 0 : (1 << 11);
		$writer->writeInt($flags);
		if(is_null($reply_to_msg_id) === false):
			$writer->writeInt($reply_to_msg_id);
		endif;
		if(is_null($reply_to_peer_id) === false):
			$writer->write($reply_to_peer_id->read());
		endif;
		if(is_null($reply_from) === false):
			$writer->write($reply_from->read());
		endif;
		if(is_null($reply_media) === false):
			$writer->write($reply_media->read());
		endif;
		if(is_null($reply_to_top_id) === false):
			$writer->writeInt($reply_to_top_id);
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
		if(is_null($todo_item_id) === false):
			$writer->writeInt($todo_item_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['reply_to_scheduled'] = true;
		else:
			$result['reply_to_scheduled'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['forum_topic'] = true;
		else:
			$result['forum_topic'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['quote'] = true;
		else:
			$result['quote'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['reply_to_msg_id'] = $reader->readInt();
		else:
			$result['reply_to_msg_id'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['reply_to_peer_id'] = $reader->tgreadObject();
		else:
			$result['reply_to_peer_id'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['reply_from'] = $reader->tgreadObject();
		else:
			$result['reply_from'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['reply_media'] = $reader->tgreadObject();
		else:
			$result['reply_media'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['reply_to_top_id'] = $reader->readInt();
		else:
			$result['reply_to_top_id'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['quote_text'] = $reader->tgreadBytes();
		else:
			$result['quote_text'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['quote_entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['quote_entities'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['quote_offset'] = $reader->readInt();
		else:
			$result['quote_offset'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['todo_item_id'] = $reader->readInt();
		else:
			$result['todo_item_id'] = null;
		endif;
		return new self($result);
	}
}

?>