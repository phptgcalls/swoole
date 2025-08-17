<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date true imported true saved_out peer from_id string from_name int channel_post string post_author peer saved_from_peer int saved_from_msg_id peer saved_from_id string saved_from_name int saved_date string psa_type
 * @return MessageFwdHeader
 */

final class MessageFwdHeader extends Instance {
	public function request(int $date,? true $imported = null,? true $saved_out = null,? object $from_id = null,? string $from_name = null,? int $channel_post = null,? string $post_author = null,? object $saved_from_peer = null,? int $saved_from_msg_id = null,? object $saved_from_id = null,? string $saved_from_name = null,? int $saved_date = null,? string $psa_type = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4e4df4bb);
		$flags = 0;
		$flags |= is_null($imported) ? 0 : (1 << 7);
		$flags |= is_null($saved_out) ? 0 : (1 << 11);
		$flags |= is_null($from_id) ? 0 : (1 << 0);
		$flags |= is_null($from_name) ? 0 : (1 << 5);
		$flags |= is_null($channel_post) ? 0 : (1 << 2);
		$flags |= is_null($post_author) ? 0 : (1 << 3);
		$flags |= is_null($saved_from_peer) ? 0 : (1 << 4);
		$flags |= is_null($saved_from_msg_id) ? 0 : (1 << 4);
		$flags |= is_null($saved_from_id) ? 0 : (1 << 8);
		$flags |= is_null($saved_from_name) ? 0 : (1 << 9);
		$flags |= is_null($saved_date) ? 0 : (1 << 10);
		$flags |= is_null($psa_type) ? 0 : (1 << 6);
		$writer->writeInt($flags);
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		if(is_null($from_name) === false):
			$writer->tgwriteBytes($from_name);
		endif;
		$writer->writeInt($date);
		if(is_null($channel_post) === false):
			$writer->writeInt($channel_post);
		endif;
		if(is_null($post_author) === false):
			$writer->tgwriteBytes($post_author);
		endif;
		if(is_null($saved_from_peer) === false):
			$writer->write($saved_from_peer->read());
		endif;
		if(is_null($saved_from_msg_id) === false):
			$writer->writeInt($saved_from_msg_id);
		endif;
		if(is_null($saved_from_id) === false):
			$writer->write($saved_from_id->read());
		endif;
		if(is_null($saved_from_name) === false):
			$writer->tgwriteBytes($saved_from_name);
		endif;
		if(is_null($saved_date) === false):
			$writer->writeInt($saved_date);
		endif;
		if(is_null($psa_type) === false):
			$writer->tgwriteBytes($psa_type);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 7)):
			$result['imported'] = true;
		else:
			$result['imported'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['saved_out'] = true;
		else:
			$result['saved_out'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['from_name'] = $reader->tgreadBytes();
		else:
			$result['from_name'] = null;
		endif;
		$result['date'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['channel_post'] = $reader->readInt();
		else:
			$result['channel_post'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['post_author'] = $reader->tgreadBytes();
		else:
			$result['post_author'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['saved_from_peer'] = $reader->tgreadObject();
		else:
			$result['saved_from_peer'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['saved_from_msg_id'] = $reader->readInt();
		else:
			$result['saved_from_msg_id'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['saved_from_id'] = $reader->tgreadObject();
		else:
			$result['saved_from_id'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['saved_from_name'] = $reader->tgreadBytes();
		else:
			$result['saved_from_name'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['saved_date'] = $reader->readInt();
		else:
			$result['saved_date'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['psa_type'] = $reader->tgreadBytes();
		else:
			$result['psa_type'] = null;
		endif;
		return new self($result);
	}
}

?>