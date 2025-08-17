<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param geopoint geo string title string address string provider string venue_id string venue_type replymarkup reply_markup
 * @return BotInlineMessage
 */

final class BotInlineMessageMediaVenue extends Instance {
	public function request(object $geo,string $title,string $address,string $provider,string $venue_id,string $venue_type,? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8a86659c);
		$flags = 0;
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($geo->read());
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($address);
		$writer->tgwriteBytes($provider);
		$writer->tgwriteBytes($venue_id);
		$writer->tgwriteBytes($venue_type);
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['geo'] = $reader->tgreadObject();
		$result['title'] = $reader->tgreadBytes();
		$result['address'] = $reader->tgreadBytes();
		$result['provider'] = $reader->tgreadBytes();
		$result['venue_id'] = $reader->tgreadBytes();
		$result['venue_type'] = $reader->tgreadBytes();
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>