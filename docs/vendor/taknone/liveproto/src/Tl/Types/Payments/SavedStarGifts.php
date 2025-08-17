<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<SavedStarGift> gifts Vector<Chat> chats Vector<User> users bool chat_notifications_enabled string next_offset
 * @return payments.SavedStarGifts
 */

final class SavedStarGifts extends Instance {
	public function request(int $count,array $gifts,array $chats,array $users,? bool $chat_notifications_enabled = null,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x95f389b1);
		$flags = 0;
		$flags |= is_null($chat_notifications_enabled) ? 0 : (1 << 1);
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		if(is_null($chat_notifications_enabled) === false):
			$writer->tgwriteBool($chat_notifications_enabled);
		endif;
		$writer->tgwriteVector($gifts,'SavedStarGift');
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['chat_notifications_enabled'] = $reader->tgreadBool();
		else:
			$result['chat_notifications_enabled'] = null;
		endif;
		$result['gifts'] = $reader->tgreadVector('SavedStarGift');
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>