<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Filters\Filter;

use Tak\Liveproto\Filters\Filter;

final class Chats extends Filter {
	public function __construct(int ...$ids){
		$this->items = array_filter($ids);
	}
	public function apply(object $update) : bool {
		if(isset($update->message) and $update->message instanceof \Tak\Liveproto\Tl\Types\Other\Message):
			return in_array($this->getId($update->message->from_id ?: new stdClass),$this->items) || in_array($this->getId($update->message->peer_id),$this->items);
		elseif($update instanceof \Tak\Liveproto\Tl\Types\Other\UpdateBotCallbackQuery):
			return in_array($update->user_id,$this->items) || in_array($this->getId($update->peer),$this->items);
		elseif($update instanceof \Tak\Liveproto\Tl\Types\Other\UpdateBotInlineSend):
			return in_array($update->user_id,$this->items);
		elseif($update instanceof \Tak\Liveproto\Tl\Types\Other\UpdateBotInlineQuery):
			return in_array($update->user_id,$this->items);
		elseif($update instanceof \Tak\Liveproto\Tl\Types\Other\UpdateBotCallbackQuery):
			return in_array($update->user_id,$this->items) || in_array($this->getId($update->peer),$this->items);
		elseif($update instanceof \Tak\Liveproto\Tl\Types\Other\UpdateInlineBotCallbackQuery):
			return in_array($update->user_id,$this->items);
		elseif($update instanceof \Tak\Liveproto\Tl\Types\Other\UpdateDraftMessage):
			return in_array($this->getId($update->peer),$this->items);
		elseif($update instanceof \Tak\Liveproto\Tl\Types\Other\UpdateStory):
			return in_array($this->getId($update->peer),$this->items);
		endif;
		return false;
	}
	private function getId(object $peer) : int {
		if(isset($peer->user_id) and is_int($peer->user_id)):
			return $peer->user_id;
		elseif(isset($peer->chat_id) and is_int($peer->chat_id)):
			return $peer->chat_id;
		elseif(isset($peer->channel_id) and is_int($peer->channel_id)):
			return $peer->channel_id;
		else:
			return 0;
		endif;
	}
}

?>