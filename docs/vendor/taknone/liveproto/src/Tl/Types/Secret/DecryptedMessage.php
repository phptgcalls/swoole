<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long random_id int ttl string message true no_webpage true silent decryptedmessagemedia media Vector<MessageEntity> entities string via_bot_name long reply_to_random_id long grouped_id
 * @return secret.DecryptedMessage
 */

final class DecryptedMessage extends Instance {
	public function request(int $random_id,int $ttl,string $message,? true $no_webpage = null,? true $silent = null,? object $media = null,? array $entities = null,? string $via_bot_name = null,? int $reply_to_random_id = null,? int $grouped_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x91cc4674);
		$flags = 0;
		$flags |= is_null($no_webpage) ? 0 : (1 << 1);
		$flags |= is_null($silent) ? 0 : (1 << 5);
		$flags |= is_null($media) ? 0 : (1 << 9);
		$flags |= is_null($entities) ? 0 : (1 << 7);
		$flags |= is_null($via_bot_name) ? 0 : (1 << 11);
		$flags |= is_null($reply_to_random_id) ? 0 : (1 << 3);
		$flags |= is_null($grouped_id) ? 0 : (1 << 17);
		$writer->writeInt($flags);
		$writer->writeLong($random_id);
		$writer->writeInt($ttl);
		$writer->tgwriteBytes($message);
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($via_bot_name) === false):
			$writer->tgwriteBytes($via_bot_name);
		endif;
		if(is_null($reply_to_random_id) === false):
			$writer->writeLong($reply_to_random_id);
		endif;
		if(is_null($grouped_id) === false):
			$writer->writeLong($grouped_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['no_webpage'] = true;
		else:
			$result['no_webpage'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['silent'] = true;
		else:
			$result['silent'] = false;
		endif;
		$result['random_id'] = $reader->readLong();
		$result['ttl'] = $reader->readInt();
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 9)):
			$result['media'] = $reader->tgreadObject();
		else:
			$result['media'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['via_bot_name'] = $reader->tgreadBytes();
		else:
			$result['via_bot_name'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['reply_to_random_id'] = $reader->readLong();
		else:
			$result['reply_to_random_id'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['grouped_id'] = $reader->readLong();
		else:
			$result['grouped_id'] = null;
		endif;
		return new self($result);
	}
}

?>