<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title photo photo int participants_count int color true channel true broadcast true public true megagroup true request_needed true verified true scam true fake true can_refulfill_subscription string about Vector<User> participants starssubscriptionpricing subscription_pricing long subscription_form_id botverification bot_verification
 * @return ChatInvite
 */

final class ChatInvite extends Instance {
	public function request(string $title,object $photo,int $participants_count,int $color,? true $channel = null,? true $broadcast = null,? true $public = null,? true $megagroup = null,? true $request_needed = null,? true $verified = null,? true $scam = null,? true $fake = null,? true $can_refulfill_subscription = null,? string $about = null,? array $participants = null,? object $subscription_pricing = null,? int $subscription_form_id = null,? object $bot_verification = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5c9d3702);
		$flags = 0;
		$flags |= is_null($channel) ? 0 : (1 << 0);
		$flags |= is_null($broadcast) ? 0 : (1 << 1);
		$flags |= is_null($public) ? 0 : (1 << 2);
		$flags |= is_null($megagroup) ? 0 : (1 << 3);
		$flags |= is_null($request_needed) ? 0 : (1 << 6);
		$flags |= is_null($verified) ? 0 : (1 << 7);
		$flags |= is_null($scam) ? 0 : (1 << 8);
		$flags |= is_null($fake) ? 0 : (1 << 9);
		$flags |= is_null($can_refulfill_subscription) ? 0 : (1 << 11);
		$flags |= is_null($about) ? 0 : (1 << 5);
		$flags |= is_null($participants) ? 0 : (1 << 4);
		$flags |= is_null($subscription_pricing) ? 0 : (1 << 10);
		$flags |= is_null($subscription_form_id) ? 0 : (1 << 12);
		$flags |= is_null($bot_verification) ? 0 : (1 << 13);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		if(is_null($about) === false):
			$writer->tgwriteBytes($about);
		endif;
		$writer->write($photo->read());
		$writer->writeInt($participants_count);
		if(is_null($participants) === false):
			$writer->tgwriteVector($participants,'User');
		endif;
		$writer->writeInt($color);
		if(is_null($subscription_pricing) === false):
			$writer->write($subscription_pricing->read());
		endif;
		if(is_null($subscription_form_id) === false):
			$writer->writeLong($subscription_form_id);
		endif;
		if(is_null($bot_verification) === false):
			$writer->write($bot_verification->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['channel'] = true;
		else:
			$result['channel'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['broadcast'] = true;
		else:
			$result['broadcast'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['public'] = true;
		else:
			$result['public'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['megagroup'] = true;
		else:
			$result['megagroup'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['request_needed'] = true;
		else:
			$result['request_needed'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['verified'] = true;
		else:
			$result['verified'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['scam'] = true;
		else:
			$result['scam'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['fake'] = true;
		else:
			$result['fake'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['can_refulfill_subscription'] = true;
		else:
			$result['can_refulfill_subscription'] = false;
		endif;
		$result['title'] = $reader->tgreadBytes();
		if($flags & (1 << 5)):
			$result['about'] = $reader->tgreadBytes();
		else:
			$result['about'] = null;
		endif;
		$result['photo'] = $reader->tgreadObject();
		$result['participants_count'] = $reader->readInt();
		if($flags & (1 << 4)):
			$result['participants'] = $reader->tgreadVector('User');
		else:
			$result['participants'] = null;
		endif;
		$result['color'] = $reader->readInt();
		if($flags & (1 << 10)):
			$result['subscription_pricing'] = $reader->tgreadObject();
		else:
			$result['subscription_pricing'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['subscription_form_id'] = $reader->readLong();
		else:
			$result['subscription_form_id'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['bot_verification'] = $reader->tgreadObject();
		else:
			$result['bot_verification'] = null;
		endif;
		return new self($result);
	}
}

?>